import {SettingInterface} from "~/js/Interfaces/Settings/Elements/Settings/SettingInterface";
import {HasLabelTrait} from "~/js/Interfaces/Settings/Elements/Settings/Traits/HasLabelTrait";
import {HasPlaceholderTrait} from "~/js/Interfaces/Settings/Elements/Settings/Traits/HasPlaceholderTrait";

export interface TextSettingInterface extends SettingInterface, HasLabelTrait, HasPlaceholderTrait {

}
