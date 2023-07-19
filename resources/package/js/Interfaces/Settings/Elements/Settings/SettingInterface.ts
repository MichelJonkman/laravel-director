import {ElementInterface} from "~/js/Interfaces/Settings/Elements/ElementInterface";
import {HasLabelTrait} from "~/js/Interfaces/Settings/Elements/Settings/Traits/HasLabelTrait";
import {HasPlaceholderTrait} from "~/js/Interfaces/Settings/Elements/Settings/Traits/HasPlaceholderTrait";

export interface SettingInterface extends ElementInterface {
    default?: string;
    value?: string;
}
