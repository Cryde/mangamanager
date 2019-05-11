
import {handleAddBook} from "./add-book";
import {handleAddTome} from "./add-single-tome";
import {handleRemoveBook} from "./remove-book";

export default () => {
  handleAddBook();
  handleAddTome();
  handleRemoveBook();
}