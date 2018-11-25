import Action from './Action';
import Migration from './Migration';

export default class MigrationBuilder
{
    public date: Date = new Date;
    public name: string | null = null;
    public downAction: DownAction = DownAction.RevertChanges;
    public disableForeignKeyChecks: boolean = false;
    public actions: Action[] = [];

    public build(): Migration {
        throw new Error('Not Implemented');
    }
}

export enum DownAction
{
    RevertChanges,
    ThrowException,
    DoNothing,
}
