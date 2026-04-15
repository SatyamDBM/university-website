export function initGlobalSearch(inputId, url, tableBodyId) {

    let timer;

    const input = document.getElementById(inputId);

    if (!input) {
        console.error("Search input not found:", inputId);
        return;
    }

    input.addEventListener('keyup', function () {

        clearTimeout(timer);

        timer = setTimeout(() => {

            fetch(url + '?search=' + this.value, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById(tableBodyId).innerHTML = html;
            });

        }, 300);

    });
}