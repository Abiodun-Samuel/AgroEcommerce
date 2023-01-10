export const PWD_REGEX =
  /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%]).{9,24}$/;

export const NAME_REGEX = /^[a-zA-Z]{3,50}$/;
export const EMAIL_REGEX = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
export const PHONE_REGEX =
  /^\(?([0])\)?([7|8|9])\)?([0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
