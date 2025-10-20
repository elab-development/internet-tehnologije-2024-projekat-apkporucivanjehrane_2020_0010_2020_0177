import './Dugme.css';

const Dugme = ({ children, onClick, tip = 'primary', disabled = false, className = '' }) => {
  return (
    <button
      className={`dugme dugme-${tip} ${className}`}
      onClick={onClick}
      disabled={disabled}
    >
      {children}
    </button>
  );
};

export default Dugme;

