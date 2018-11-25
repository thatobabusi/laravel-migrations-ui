import Connection from './Connection';
import Migration from './Migration';

export default class Application
{
    public connections(): Connection[] {
        throw new Error('Not Implemented');
    }

    public migrations(): Migration[] {
        throw new Error('Not Implemented');
    }
}
