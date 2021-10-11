interface UserDefaults {
  // The absence of a value represents 'system'
  colorThemeOverride?: 'dark' | 'light';
}

function getUserSettings(): UserDefaults {
  return { colorThemeOverride: undefined };
}

const settings = getUserSettings();
// Settings.colorThemeOverride = 'dark';
// settings.colorThemeOverride = 'light';

// But not:
settings.colorThemeOverride = undefined;
// Type 'undefined' is not assignable to type '"dark" | "light"' with 'exactOptionalPropertyTypes: true'.
// Consider adding 'undefined' to the type of the target.
