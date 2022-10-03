import {ElementInterface} from "~/js/Interfaces/Menu/Elements/ElementInterface";
import {MenuElementsInterface} from "~/js/Interfaces/Menu/MenuElementsInterface";

export interface GroupElementInterface extends ElementInterface {
    children: MenuElementsInterface;
}
