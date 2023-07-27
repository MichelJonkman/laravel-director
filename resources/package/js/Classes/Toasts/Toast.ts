import {ToastInterface} from "~/js/Classes/Toasts/ToastInterface";
import {reactive} from "vue";
import {randomString} from "~/js/helpers";

export const toasts: { [id: string]: Toast } = reactive({});

export class Toast implements ToastInterface {
    id: string;
    type: string;
    message: string;
    ttl: number;

    constructor(type: string, message: string, ttl: number = 5) {
        this.type = type;
        this.message = message;
        this.ttl = ttl;

        this.id = this.generateId();

        setTimeout(() => this.remove(), ttl * 1000);
    }

    static new(type: string, message: string, ttl: number = 5) {
        const newToast = new Toast(type, message, ttl);

        toasts[newToast.id] = newToast;
    }

    public remove() {
        delete toasts[this.id];
    }

    protected generateId() {
        let id = '';
        let idExists = true;

        while (idExists) {
            id = randomString(8);

            idExists = toasts.hasOwnProperty(id);
        }

        return id;
    }
}
