import {defineStore} from 'pinia';

export const useSidebarStore = defineStore('sidebar', {

    state: () => {
        let sidebarClosed = false;

        if(window.innerWidth < 1400) {
            sidebarClosed = true;
        }

        return {
            sidebarClosed: sidebarClosed
        };
    },

    actions: {
        toggleSidebar() {
            this.sidebarClosed = !this.sidebarClosed;
        },
    },
});