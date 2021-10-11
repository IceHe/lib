const createKeyboard = (modelID: number) => {
  const defaultModelID = 23;
  // 'defaultModelID' is declared but its value is never read.
  return { type: 'keyboard', modelID };
};
