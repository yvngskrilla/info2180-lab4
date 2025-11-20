document.addEventListener('DOMContentLoaded', () => {
	// Try common IDs/classes first, then fall back to any button with text 'Search'
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
		// If there's no button present in the page, log a helpful message and exit.
		console.warn('Search button not found. Add a button with id="search" or text "Search".');
		return;
	}

	btn.addEventListener('click', async (e) => {
		// Prevent default in case the button is inside a form
		if (e && typeof e.preventDefault === 'function') e.preventDefault();

		try {
			const response = await fetch('superheroes.php');
			if (!response.ok) throw new Error('Network response was not ok: ' + response.status);
			const text = await response.text();

			// Try parsing JSON; if it's an array of names, join them with newlines.
			try {
				const data = JSON.parse(text);
				if (Array.isArray(data)) {
					alert(data.join('\n'));
				} else if (typeof data === 'object') {
					// Pretty-print objects
					alert(JSON.stringify(data, null, 2));
				} else {
					alert(String(data));
				}
			} catch (err) {
				// Not JSON — show raw text
				alert(text);
			}
		} catch (err) {
			alert('Error fetching superheroes: ' + err.message);
		}
	});
});

