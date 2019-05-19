
import {handleAddBook} from "./add-book";
import {handleAddTome} from "./add-single-tome";
import {handleRemoveBook} from "./remove-book";
import {handleAddAllTome} from "./add-all-tome";

export default () => {
  handleAddBook();
  handleAddTome();
  handleRemoveBook();
  handleAddAllTome();
}