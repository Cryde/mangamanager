export {debounce, waiting, templateBook};

const debounce = (func, delay) => {
  let inDebounce;
  return function () {
    const context = this;
    const args = arguments;
    clearTimeout(inDebounce);
    inDebounce = setTimeout(() => func.apply(context, args), delay)
  }
};


function waiting() {
  return `<div class="col-lg-4 offset-lg-4 text-center"><i class="fas fa-spinner fa-3x fa-pulse"></i></div>`;
}

function templateBook({id, title, cover_url, url}, userLogged, isInCollection) {

  const templateAddButton = userLogged && !isInCollection ? templateButtonAdd(id) : '';

  return `
    <div class="col-lg-3 mt-lg-4">  
        <div class="card">
          <img src="${cover_url}" alt="${title}" class="img-fluid card-img-top"/>
          <div class="card-body">
              <h6 class="card-title">${title}</h6>
              <a href="${url}" target="_blank" class="btn btn-outline-primary btn-block">
                  <i class="far fa-eye"></i> Voir
              </a>
              ${templateAddButton}
          </div>
      </div>
    </div>
  `;
}

function templateButtonAdd(bookId) {
    return `
      <a href="#" data-book-id="${bookId}" class="btn btn-outline-primary btn-block js-add-book-collection">
            <i class="fas fa-plus"></i> Ajouter
        </a>
    `;
}
