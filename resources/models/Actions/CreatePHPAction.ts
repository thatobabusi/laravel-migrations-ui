import Action from '../Action';

export default class CreatePHPAction extends Action
{
    public upCode: string;
    public downCode: string;

    public buildUpCode(): string {
        return this.upCode;
    }

    public buildDownCode(): string {
        return this.downCode;
    }
}
