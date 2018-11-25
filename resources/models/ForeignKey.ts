import Column from './Column';
import Table from './Table';

export default class ForeignKey
{
    public table: Table;
    public relatedTable: Table;
    public columns: [Column, Column][];
    public name: string;
    public comment: string;
    public onUpdate: ReferenceOption | null;
    public onDelete: ReferenceOption | null;
}

export enum ReferenceOption
{
    Restrict,
    Cascade,
    SetNull,
    // NoAction, // Equivalent to Restrict
    // SetDefault, // Not accepted by InnoDB
}
