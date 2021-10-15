interface GameSettings {
    speed: 'fast' | 'medium' | 'slow';
    quality: 'high' | 'low';
    [key: string]: string;
}
declare function getSettings(): {
    speed: string;
    quality: string;
    username: string;
};
declare const settings: {
    speed: string;
    quality: string;
    username: string;
};
