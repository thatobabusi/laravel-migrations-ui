import Column from './Column';
import Table from './Table';

export default class Index
{
    public table: Table;
    public columns: Column[];
    public name: string;
    public type: IndexType;
    public comment: string;
}

export enum IndexType
{
    Primary,
    Unique,
    Index,
    FullText,
    Spatial,
}
