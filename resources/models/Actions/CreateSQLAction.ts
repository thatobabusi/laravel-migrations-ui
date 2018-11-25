import Action from '../Action';
import Connection from '../Connection';

export default class CreateSQLAction extends Action
{
    public connection: Connection;
    public upCode: string;
    public downCode: string;

    public buildUpCode(): string {
        throw new Error('Not Implemented');
    }

    public buildDownCode(): string {
        throw new Error('Not Implemented');
    }
}
