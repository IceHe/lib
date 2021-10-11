const a = 6;

switch (a) {
  case 0:
    // Fallthrough case in switch.
    console.log('even');

  case 1:
    console.log('odd');
    break;

  default:
    break;
}
