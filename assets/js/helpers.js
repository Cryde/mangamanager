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

function templateBook({title, cover_url, url}) {
  return `
    <div class="col-lg-3 text-center">
      <a href="${url}">
          ${title}
          <img src="${cover_url}" alt="${title}" class="img-fluid"/>
      </a>
    </div>
  `;
}