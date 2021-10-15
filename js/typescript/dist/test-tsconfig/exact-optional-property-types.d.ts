interface UserDefaults {
    colorThemeOverride?: 'dark' | 'light';
}
declare function getUserSettings(): UserDefaults;
declare const settings: UserDefaults;
