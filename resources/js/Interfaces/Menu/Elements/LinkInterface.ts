import {ElementInterface} from "~/js/Interfaces/Menu/Elements/ElementInterface";

export interface LinkInterface extends ElementInterface {
    isLink: boolean;
    url: string;
    active?: boolean;
}