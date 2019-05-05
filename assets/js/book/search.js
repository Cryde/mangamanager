import {debounce, waiting, templateBook} from "../helpers";

export {handleSearch};

let resultContainer = null;

function handleSearch() {
  const element = document.querySelector('.js-search-book');

  if (!element) {
    return;
  }

  resultContainer = document.querySelector('.js-results');

  element.addEventListener('keydown', debounce(function () {
    const value = this.value;

    if (value.length > 3) {

      resultContainer.innerHTML = waiting();

      getResult(value)
      .then(displayResults)
    }

  }, 500));
}

function getResult(q) {
  return fetch(Routing.generate('api_book_search', {q})).then((response) => response.json());
}

function displayResults(results) {

  const books = results.data;

  let htmlResult = '';

  for (const book of books) {
    htmlResult += templateBook(book);
  }

  resultContainer.innerHTML = htmlResult;
}

