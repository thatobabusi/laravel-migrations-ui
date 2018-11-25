import Action from '../Action';
import Connection from '../Connection';
import Database from '../Database';
import Table from '../Table';

export default class CreateTableAction extends Action
{
    public connection: Connection;
    public database: Database;
    public table: Table;

    public buildUpCode(): string {
        throw new Error('Not Implemented');
    }

    public buildDownCode(): string {
        throw new Error('Not Implemented');
    }
}
