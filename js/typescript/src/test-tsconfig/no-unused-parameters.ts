const createDefaultKeyboard = (modelID: number) => {
  // 'modelID' is declared but its value is never read.
  const defaultModelID = 23;
  return { type: 'keyboard', modelID: defaultModelID };
};
