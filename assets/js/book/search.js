import {waiting, templateBook} from "../helpers";

export {handleSearch};

let resultContainer = null;
let lastSearch = '';

function handleSearch() {
  const element = document.querySelector('.js-search-book');

  if (!element) {
    return;
  }

  resultContainer = document.querySelector('.js-results');

  element.addEventListener('keydown', function (e) {
    const code = (e.keyCode ? e.keyCode : e.which);

    if(code === 13) {
      e.preventDefault();
      const value = this.value;
      if (value.length > 3 && lastSearch !== value) {
        resultContainer.innerHTML = waiting();
        lastSearch = value;
        launchSearch(value);
      }
    }
  });
}

function launchSearch(value) {
  getResult(value)
  .then(displayResults);
}

function getResult(q) {
  return fetch(Routing.generate('api_book_search', {q})).then((response) => response.json());
}

function displayResults(results) {

  const books = results.data;

  if(!books.length) {
    displayNoResult();
    return;
  }

  let htmlResult = '';

  for (const book of books) {
    htmlResult += templateBook(book);
  }

  resultContainer.innerHTML = htmlResult;
}

function displayNoResult() {
  resultContainer.innerHTML = `
  <div class="col-lg-12 mt-lg-5">
  <div class="text-center">
    Nous n'avons pas trouvé de résultats pour votre recherche.<br/>
  </div>
  </div>
  `;
}
