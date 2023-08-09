import {defineStore} from 'pinia';

export const useSidebarStore = defineStore('sidebar', {

    state: () => {
        let sidebarClosed = false;
        let settingsSidebarClosed = false;

        if(window.innerWidth < 1400) {
            sidebarClosed = true;
            settingsSidebarClosed = true;
        }

        return {
            sidebarClosed,
            settingsSidebarClosed,
        };
    },

    actions: {
        toggleSidebar() {
            this.sidebarClosed = !this.sidebarClosed;
            if(window.innerWidth < 800 && !this.sidebarClosed && !this.settingsSidebarClosed) {
                this.settingsSidebarClosed = !this.settingsSidebarClosed;
            }
        },
        toggleSettingsSidebar() {
            this.settingsSidebarClosed = !this.settingsSidebarClosed;
            if(window.innerWidth < 800 && !this.settingsSidebarClosed && !this.sidebarClosed) {
                this.sidebarClosed = !this.sidebarClosed;
            }
        },
    },
});
