export {handleAdd};

function handleAdd() {
  handleAddToCollectionClick();
}


function handleAddToCollectionClick() {
  const element = document.querySelector('.js-add-book-collection');

  if (!element) {
    return;
  }

  element.addEventListener('click', function (e) {
    e.preventDefault();

    const bookId = this.getAttribute('data-book-id');

    addToCollection(bookId)
    .then(() => {

    })
  });
}


function addToCollection(id) {
  const url = Routing.generate('api_collection_book_add', {id});
  return fetch(url).then((response) => response.json());
}