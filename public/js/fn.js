const addQuery = (queries) => {
    const url = window.location.href;
    const urlObj = new URL(url);
    for (const query in queries) {
        urlObj.searchParams.set(query, queries[query]);
    }
    return urlObj.toString();
};
