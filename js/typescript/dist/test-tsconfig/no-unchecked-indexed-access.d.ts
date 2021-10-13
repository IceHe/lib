interface EnvironmentVariables {
  NAME: string;
  OS: string;
  [propName: string]: string;
}
declare const env: EnvironmentVariables;
declare const sysName: string;
declare const os: string;
declare const nodeEnv: string | undefined;
