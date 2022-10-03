import {ElementInterface} from "~/js/Interfaces/Menu/Elements/ElementInterface";

export interface GroupElementInterface extends ElementInterface {
    children: ElementInterface[];
}
