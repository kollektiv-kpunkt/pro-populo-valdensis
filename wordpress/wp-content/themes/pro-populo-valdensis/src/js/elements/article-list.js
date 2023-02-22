if (document.querySelector(".ppv-article-list-wrapper")) {
    let searchBar = document.querySelector(".ppv-article-list-searchbar-wrapper");
    if (searchBar) {
        let query = searchBar.querySelector("input[name='query']");
        let category = searchBar.querySelector("select[name='categories']");
        let tags = searchBar.querySelector("select[name='tags']");
        let submit = searchBar.querySelector("button[type='submit']");
        let catPage = searchBar.dataset.isCatPage || false;
        submit.addEventListener("click", (e) => {
            let url = new URL(window.location.href);
            url.searchParams.delete("q");
            url.searchParams.delete("categories");
            url.searchParams.delete("tags");
            let params = url.searchParams;
            if (query.value) {
                params.set("q", query.value);
            }
            if (category.value && !catPage) {
                params.set("categories", category.value);
            }
            if (tags.value) {
                params.set("tags", tags.value);
            }
            window.location.href = url;
        });

        let button = document.querySelector(".ppv-article-list-open-searchbar");
        button.addEventListener("click", (e) => {
            e.preventDefault();
            if (searchBar.classList.contains("ppv-article-list-searchbar-open")) {
                searchBar.classList.remove("ppv-article-list-searchbar-open");
                searchBar.style.transition = "none";
                searchBar.style.maxHeight = searchBar.scrollHeight + "px";
                setTimeout(() => {
                    searchBar.style.transition = "";
                    searchBar.style.maxHeight = "0px";
                    searchBar.style.overflow = "hidden";
                }, 0);
            } else {
                searchBar.classList.add("ppv-article-list-searchbar-open");
                searchBar.style.maxHeight = searchBar.scrollHeight + "px";
                setTimeout(() => {
                    searchBar.style.maxHeight = "100%";
                    searchBar.style.overflow = "visible";
                }, 500);
            };
        });
    }
}