export {handleAddBook};

function handleAddBook() {
  handleAddToCollectionClick();
}


function handleAddToCollectionClick() {
  const element = document.querySelector('.js-add-book-collection');

  if (!element) {
    return;
  }

  element.addEventListener('click', function clickAddBookCollection(e) {
    e.preventDefault();

    const bookId = this.getAttribute('data-book-id');

    addToCollection(bookId)
    .then(() => {


      element.classList.remove('btn-outline-primary');
      element.classList.add('btn-outline-success');
      element.removeEventListener('click', clickAddBookCollection);
      element.innerHTML = `<i class="fas fa-check"></i> Dans votre collection`;
    })
  });
}


function addToCollection(id) {
  const url = Routing.generate('api_collection_book_add', {id});
  return fetch(url).then((response) => response.json());
}