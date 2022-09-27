export interface MenuInterface {
    [name: string]: ButtonInterface
}

export interface ButtonInterface {
    iconLink: string;
    content: string;
    url: string;
    position: number;
}
