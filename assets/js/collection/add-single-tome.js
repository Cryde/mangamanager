export {handleAddTome};

function handleAddTome() {
  handleAddToCollectionClick();
}


function handleAddToCollectionClick() {
  const elements = Array.prototype.slice.call(document.querySelectorAll('.js-read-tome'));

  if (!elements.length) {
    return;
  }

  elements.forEach( (element) => {
    element.addEventListener('click', function clickAddToCollection(e) {
      e.preventDefault();

      const bookId = this.getAttribute('data-tome-id');

      addToCollection(bookId)
      .then(() => {

        element.classList.remove('btn-outline-secondary');
        element.classList.add('btn-outline-success');
        element.removeEventListener('click', clickAddToCollection);
        element.innerHTML = `<i class="far fa-check-square"></i> Lu`;
      })
    });
  })
}


function addToCollection(id) {
  const url = Routing.generate('api_collection_tome_add', {id});
  return fetch(url).then((response) => response.json());
}