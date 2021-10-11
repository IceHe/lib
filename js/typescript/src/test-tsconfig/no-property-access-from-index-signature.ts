interface GameSettings {
  // Known up-front properties
  speed: 'fast' | 'medium' | 'slow';
  quality: 'high' | 'low';

  // Assume anything unknown to the interface
  // is a string.
  [key: string]: string;
}

function getSettings() {
  return { speed: 'fast', quality: 'high', username: 'icehe' };
}

const settings = getSettings();
settings.speed;
// (property) GameSettings.speed: "fast" | "medium" | "slow"

settings.quality;
// (property) GameSettings.quality: "high" | "low"

// Unknown key accessors are allowed on
// this object, and are `string`
settings.username;
