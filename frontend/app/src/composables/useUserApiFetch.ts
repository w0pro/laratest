import { useForm } from 'laravel-precognition-vue';
import { RequestMethod} from 'laravel-precognition';

export function useUserApiFetch(path: string, method: RequestMethod | (() => RequestMethod), inputs: {}) {
    return useForm(method, `http://localhost/${path}`, inputs);

}
