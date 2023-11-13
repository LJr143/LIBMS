
    const listItems = document.querySelectorAll('li');
    listItems.forEach((listItem) => {
    listItem.addEventListener('click', () => {
        listItems.forEach((item) => {
            item.classList.remove('active');
        });

        listItem.classList.add('active');
    });
});