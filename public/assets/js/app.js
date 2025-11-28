document.addEventListener('DOMContentLoaded', () => {
  const titleInput  = document.getElementById('title');
  const artistInput = document.getElementById('artist');

  function debounce(fn, ms = 250) {
    let t;
    return (...args) => {
      clearTimeout(t);
      t = setTimeout(() => fn(...args), ms);
    };
  }

  function attachAutocomplete(input, field) {
    if (!input) return;

    input.addEventListener('input', debounce(async () => {
      const q = input.value.trim();
      if (q === '') return;

      try {
        const res = await fetch(`autocomplete.php?q=${encodeURIComponent(q)}&field=${encodeURIComponent(field)}`);
        const data = await res.json();

        let list = document.getElementById(field + '-list');
        if (!list) {
          list = document.createElement('div');
          list.id = field + '-list';
          list.className = 'suggestion-list';
          input.parentNode.appendChild(list);
        }

        list.innerHTML = '';
        data.forEach(item => {
          const div = document.createElement('div');
          div.className = 'suggestion-item';
          div.textContent = item;
          div.addEventListener('click', () => {
            input.value = item;
            list.innerHTML = '';
          });
          list.appendChild(div);
        });
      } catch (e) {
        console.error(e);
      }
    }, 300));
  }

  attachAutocomplete(titleInput, 'title');
  attachAutocomplete(artistInput, 'artist');

  // Live search (display quick list above table)
  const form = document.getElementById('searchForm');
  const liveDiv = document.getElementById('liveResults');

  if (form && liveDiv) {
    form.addEventListener('input', debounce(async () => {
      const params = new URLSearchParams(new FormData(form));
      try {
        const res = await fetch('api_search.php?' + params.toString());
        const data = await res.json();

        if (!Array.isArray(data) || data.length === 0) {
          liveDiv.innerHTML = '';
          return;
        }

        liveDiv.innerHTML = '<h3>Live Results</h3><ul>' +
          data.map(s => `<li>${s.title} — ${s.artist} (${s.year || ''})</li>`).join('') +
          '</ul>';
      } catch (e) {
        console.error(e);
      }
    }, 350));
  }
});
