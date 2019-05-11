export {handleRemoveBook};

function handleRemoveBook() {
  handleRemoveFromCollectionClick();
}


function handleRemoveFromCollectionClick() {
  const elements = Array.prototype.slice.call(document.querySelectorAll('.js-remove-book-collection'));
  if (!elements.length) {
    return;
  }

  elements.forEach( (element) => {
    element.addEventListener('click', function clickRemoveBookCollection(e) {
      e.preventDefault();

      if (confirm(`Êtes vous sur de vouloir supprimer ce manga de votre collection ? Vous perdrez l'avancée liée à ce manga`)) {

        const bookId = this.getAttribute('data-book-id');

        remove(bookId)
        .then(() => {

          element.removeEventListener('click', clickRemoveBookCollection);

          const parent = element.closest('.book-element').parentNode;
          parent.parentElement.removeChild(parent);
        })
      }
    });
  });
}

function remove(id) {
  const url = Routing.generate('api_collection_book_remove', {id});
  return fetch(url).then((response) => response.json());
}