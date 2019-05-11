export {handleAddBook, removeAddToCollectionEventListeners};

function handleAddBook() {
  handleAddToCollectionClick();
}

function handleAddToCollectionClick() {
  const elements = getElements();

  if (!elements.length) {
    return;
  }

  elements.forEach( (element) => {
    element.addEventListener('click', clickAddBookCollection);
  });
}

function removeAddToCollectionEventListeners() {

  const elements = getElements();

  if (!elements.length) {
    return;
  }

  elements.forEach( (element) => {
    element.removeEventListener('click', clickAddBookCollection);
  });
}

function getElements() {
  return Array.prototype.slice.call(document.querySelectorAll('.js-add-book-collection'));
}

function clickAddBookCollection(e) {
  e.preventDefault();

  const bookId = this.getAttribute('data-book-id');

  addToCollection(bookId)
  .then(() => {
    this.classList.remove('btn-outline-primary');
    this.classList.add('btn-outline-success');
    this.removeEventListener('click', clickAddBookCollection);
    this.innerHTML = `<i class="fas fa-check"></i> Dans votre collection`;
  })
}

function addToCollection(id) {
  const url = Routing.generate('api_collection_book_add', {id});
  return fetch(url).then((response) => response.json());
}