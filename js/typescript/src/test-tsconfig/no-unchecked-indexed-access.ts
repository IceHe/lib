interface EnvironmentVariables {
  NAME: string;
  OS: string;

  // Unknown properties are covered by this index signature.
  [propName: string]: string;
}

declare const env: EnvironmentVariables;

// Declared as existing
const sysName = env.NAME;
const os = env.OS;

// Not declared, but because of the index
// signature, then it is considered a string
const nodeEnv = env.NODE_ENV;
// Const nodeEnv: string
