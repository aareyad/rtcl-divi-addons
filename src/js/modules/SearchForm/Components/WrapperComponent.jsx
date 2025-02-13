export const WrapperComponent = ({link, children}) =>
    link ? (
        <a href={link}>
            {children}
        </a>
    ) : (
        <>{children}</>
    );