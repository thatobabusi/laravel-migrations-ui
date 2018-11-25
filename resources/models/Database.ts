import Connection from './Connection';
import Table from './Table';

export default class Database
{
    public readonly connection: Connection;
    public readonly name: string;

    constructor(connection: Connection, name: string) {
        this.connection = connection;
        this.name = name;
    }

    public tables(): Table[] {
        throw new Error('Not Implemented');
    }
}
