import {ElementInterface} from "~/js/Interfaces/Settings/Elements/ElementInterface";

export interface PageElementInterface extends ElementInterface {
    title: string;
    slug: string;
    isPage: boolean;
    isMenu: boolean;
    active: boolean;
}
