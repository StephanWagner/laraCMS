import { valueGetter as valueGetterTextfield } from './value-textfield';
import { valueGetter as valueGetterPassword } from './value-password';
import { valueGetter as valueGetterSelect } from './value-select';

const valueGetters = {
    'textfield': valueGetterTextfield,
    'password': valueGetterPassword,
    'select': valueGetterSelect,
};

export {
    valueGetters
};
