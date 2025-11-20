document.addEventListener('DOMContentLoaded', () => {
	function findSearchButton() {
		return (
			document.getElementById('search') ||
			document.getElementById('searchButton') ||
			document.getElementById('search-btn') ||
			document.querySelector('.search') ||
			document.querySelector('.search-btn') ||
			Array.from(document.getElementsByTagName('button')).find(b => {
				const t = (b.textContent || '').trim().toLowerCase();
				return t === 'search' || t.includes('search');
			})
		);
	}

	const btn = findSearchButton();
	if (!btn) {
		console.warn('Search button not found. Add a button with id="search" or text "Search".');
		return;
	}

	const input = document.getElementById('query');

	if (input) {
		input.addEventListener('keydown', (ev) => {
			if (ev.key === 'Enter') {
				ev.preventDefault();
				btn.click();
			}
		});
	}

	btn.addEventListener('click', async (e) => {
		if (e && typeof e.preventDefault === 'function') e.preventDefault();

		try {
			const rawQuery = (input && input.value) ? input.value : '';
			const sanitizedQuery = String(rawQuery).replace(/<[^>]*>?/gm, '').trim();

			const url = 'superheroes.php' + (sanitizedQuery ? ('?query=' + encodeURIComponent(sanitizedQuery)) : '');
			const response = await fetch(url);
			if (!response.ok) throw new Error('Network response was not ok: ' + response.status);
			const text = await response.text();

			const resultDiv = document.getElementById('result');
			if (resultDiv) {
				resultDiv.innerHTML = text;
			} else {
				console.warn('Result container not found; falling back to alert.');
				alert(text);
			}
		} catch (err) {
			const resultDiv = document.getElementById('result');
			const message = 'Error fetching superheroes: ' + err.message;
			if (resultDiv) resultDiv.textContent = message;
			else alert(message);
		}
	});
});

