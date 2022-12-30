import { valueGetter as valueGetterTextfield } from './values-textfield';
import { valueGetter as valueGetterPassword } from './values-password';
import { valueGetter as valueGetterSelect } from './values-select';

const valueGetters = {
    'textfield': valueGetterTextfield,
    'password': valueGetterPassword,
    'select': valueGetterSelect,
};

export {
    valueGetters
};
