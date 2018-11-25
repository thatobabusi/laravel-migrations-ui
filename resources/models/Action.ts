export default abstract class Action
{
    public abstract buildUpCode(): string;

    public abstract buildDownCode(): string;
}
