import {ElementInterface} from "~/js/Interfaces/Settings/Elements/ElementInterface";
import {GroupElementInterface} from "~/js/Interfaces/Settings/Elements/GroupElementInterface";

export interface PageElementInterface extends ElementInterface, GroupElementInterface {
    title: string;
    slug: string;
    isPage: boolean;
    isMenu: boolean;
    active: boolean;
}
