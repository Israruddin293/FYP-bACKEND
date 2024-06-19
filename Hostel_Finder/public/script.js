document.getElementById('learnMoreBtn').addEventListener('click', function() {
    document.getElementById('aboutContent').classList.toggle('show-more');
    if (this.textContent === "Learn More") {
        this.textContent = "Show Less";
    } else {
        this.textContent = "Learn More";
    }
});

function toggleSearch() {
    const searchBar = document.getElementById('searchBar');
    searchBar.classList.toggle('active');
}

function performSearch() {
    const query = document.getElementById('searchInput').value;
    if (query) {
        window.location.href = `/search?q=${encodeURIComponent(query)}`;
    }
}

// function toggleSearch() {
//     document.getElementById('searchBar').classList.toggle('active');
// }

// function performSearch() {
//     const query = document.getElementById('searchInput').value;
//     // Perform search action with the query
//     console.log('Searching for:', query);
// }


// function toggleSearch() {
//     document.getElementById('searchBar').classList.toggle('active');
// }

// function performSearch() {
//     const query = document.getElementById('searchInput').value;
//     // Perform search action with the query
//     console.log('Searching for:', query);
// }

// function toggleSearch() {
//     const searchBar = document.getElementById('searchBar');
//     searchBar.classList.toggle('active');
// }

// function performSearch() {
//     const query = document.getElementById('searchInput').value;
//     if (query) {
//         window.location.href = `/search?q=${encodeURIComponent(query)}`;
//     }
// }