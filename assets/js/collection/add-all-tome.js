export {handleAddAllTome};

function handleAddAllTome() {
  handleAddToCollectionClick();
}


function handleAddToCollectionClick() {
  const elements = Array.prototype.slice.call(document.querySelectorAll('.js-add-all-tome-collection'));

  if (!elements.length) {
    return;
  }

  elements.forEach( (element) => {
    element.addEventListener('click', clickAddToCollection);
  })
}


function addAllToCollection(id) {
  const url = Routing.generate('api_collection_book_add_all_tome', {id});
  return fetch(url).then((response) => response.json());
}

function clickAddToCollection(e) {
  e.preventDefault();

  const bookId = this.getAttribute('data-book-id');
  console.log(bookId);

  addAllToCollection(bookId)
  .then(() => {

    this.classList.remove('btn-outline-secondary');
    this.classList.add('btn-outline-success');
    this.removeEventListener('click', clickAddToCollection);
    this.innerHTML = `<i class="far fa-check-square"></i> J'ai tout lu`;

    markAllTomeAsRead();
  })
}

function markAllTomeAsRead() {
  const elements = Array.prototype.slice.call(document.querySelectorAll('.book .card .js-read-tome'));

  if(!elements.length) {
    return;
  }


  elements.forEach( (element) => {
    element.classList.remove('btn-outline-secondary');
    element.classList.add('btn-outline-success');
    element.removeEventListener('click', clickAddToCollection);
    element.innerHTML = `<i class="far fa-check-square"></i> Lu`;
  })

}