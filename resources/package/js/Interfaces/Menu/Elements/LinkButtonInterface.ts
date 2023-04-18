import {IconTextElementInterface} from "~/js/Interfaces/Menu/Elements/IconTextElementInterface";
import {LinkInterface} from "~/js/Interfaces/Menu/Elements/LinkInterface";

export interface LinkButtonInterface extends IconTextElementInterface, LinkInterface {
    target: string;
    title?: string;
    active?: boolean;
}
